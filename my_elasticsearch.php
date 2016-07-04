<?php 
$users = AdminUsers::all();
        $total = count($users);
        // Insert all record user to index users
        $params = ['body' => []];
        for ($i=0; $i < $total; $i++) {
            $params['body'][]=[
                'index' => [
                    '_index' => 'users',
                    '_type' => 'user',
                    '_id' => $users[$i]->id
                ]
            ];
            $params['body'][] = $users[$i]->toArray();

            // Reached 100 pieces items //i should not be 0 for this
            if ($i%100 == 0 && $i !=0) {
                $responses = $client->bulk($params);

                var_dump("done......." . $i);
                unset($responses);
            }
        }
        if (trim($request->search) != '') {
            $client = Elasticsearch\ClientBuilder::create()->build();
            // Check pagination
            if ($request->page) {
                $from = $request->page * env('SIZE');
            } else {
                $from = 1;
            }
            $query = $client->search([
                'index' => 'users',
                'type' => 'user',
                'size' => env('SIZE'),
                'from' => $from,
                'body' => [
                    'query' => [
                        'bool' => [
                            'should' => [
                                'match' => ['email' => $request->search]
                            ]
                        ]
                    ]
                ]
            ]);
            if ($query['hits']['total'] >= 1) {
                $users = $query['hits']['hits'];
            }
            foreach ($users as $user) {
                echo '<div>
                    <a href="'.$user['_id'].'">'.$user['_source']['email'].'</a>
                </div>';
            }
            die;

            $listUsers = AdminUsers::where('email', 'like', '%'.$request->search.'%')->paginate(env('LIMIT_PAGINATION'))->appends(['search' => $request->search]);
        } else {
            $listUsers = AdminUsers::paginate(env('LIMIT_PAGINATION'));
        }