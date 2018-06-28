<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Helpers\Misc;


class getISRSSfeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RSS:IS';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Inside Sources RSS articles feed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $rss = new \DOMDocument();

        for ($x = 1; $x <= 3; $x++) {

        $page = "http://www.insidesources.com/feed/?paged=" . $x;

        $rss->load($page);

        foreach ($rss->getElementsByTagName('item') as $node) {
            $item = array ( 
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'short_description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                'url' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                'created_at' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                'body' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
                'guid' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
                'author' => $node->getElementsByTagName('creator')->item(0)->nodeValue,
                'category' => $node->getElementsByTagName('category')
                );
            $cats = [];

            foreach ($item['category'] as $cat) {
                $name = $cat->nodeValue;
                switch ($name) {

                    case (preg_match('/politics/i', $name) ? true : false) :
                        $cats[] = 4;
                        break;
                    case (preg_match('/trump/i', $name) ? true : false) :
                        $cats[] = 4;
                        break;
                    case (preg_match('/democrats/i', $name) ? true : false) :
                        $cats[] = 4;
                        break;
                    case (preg_match('/republicans/i', $name) ? true : false) :
                        $cats[] = 4;
                        break;
                    case  (preg_match('/technology/i', $name) ? true : false) :
                        $cats[] = 5;
                        break;
                    case  (preg_match('/business/i', $name) ? true : false) :
                        $cats[] = 6;
                        break;
                    case  (preg_match('/finance/i', $name) ? true : false) :
                        $cats[] = 6;
                        break;
                    case  (preg_match('/education/i', $name) ? true : false) :
                        $cats[] = 7;
                        break;
                    case  (preg_match('/health/i', $name) ? true : false) :
                        $cats[] = 8;
                        break;
                    case  (preg_match('/energy/i', $name) ? true : false) :
                        $cats[] = 9;
                        break;
                    case  (preg_match('/fuel/i', $name) ? true : false) :
                        $cats[] = 9;
                        break;
                    case  (preg_match('/international/i', $name) ? true : false) :
                        $cats[] = 10;
                        break;
                    case  (preg_match('/domestic policy/i', $name) ? true : false) :
                        $cats[] = 11;
                        break;
                    case  (preg_match('/forgeign policy/i', $name) ? true : false) :
                        $cats[] = 12;
                        break;
                    case  (preg_match('/point counterpoint/i', $name) ? true : false) :
                        $cats[] = 13;
                        break;
                    default :
                        echo "could not find category $name\n";
                        

                }

            } // end cat loop

            $cats = array_unique($cats);

            if (count($cats) == 0) {
                echo "NO CATS FOUND, defaulting";
                $cats[] = 13;
            }

            // i hate date manipulation

            $item['created_at'] = date('Y-m-d H:i:s', strtotime( $item['created_at'] ));  
            $item['slug'] = makeSlug($item['title']);
            $item['user_id_created'] = 1;
            $item['status'] = 'A';


            $post = new Post;

            $post->fill($item);

            $errors = $post->validate();
     
            if (isset($errors)){
                echo "validation errors\n";
                print_r($errors);
                die;
            }

            $post->save();

            $post->category()->attach($cats);

            echo "saved post {{$post->id}} in cats " . implode(' ', $cats) . "\n";


        } // end loop through each item
        } // end paging
    
    } // end handle
} // end class
