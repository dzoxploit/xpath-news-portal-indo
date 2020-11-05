<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use DiDom\Document;
use DiDom\Query;
use Carbon\Carbon;
class XpathArticlesController extends Controller
{
    /* untuk menampilkan data antara news berbasis html */
    public function index_antara_news(Request $request){
    $pagination = $request->get('page');
    $tanggal = Carbon::now()->format('d-m-Y');
    $url = 'https://www.antaranews.com/indeks/'.$tanggal.'/';
    $document = new Document('https://www.antaranews.com/indeks/'.$tanggal.'/'.$pagination.'/', true);
    $posts = $document->find("//article[contains(@class, 'simple-post simple-big clearfix')]//header//h3//a", Query::TYPE_XPATH);
    for($i = 0; $i < count($posts); $i++) {
        $coba = $posts[$i];
        $data = new \SimpleXMLElement($coba);
        $linkcuyy[$i] = $data['href'];
        $article[] = array(
            'title' => $posts[$i]->text(),
            'url' => strval($linkcuyy[$i]),
            'date' => Carbon::now()->format('Y-m-d')
        );
    }
    return view('index_antara_news',['article' => $article]);
    }
    /* untuk menampilkan detail article dari data antara news berbasis html */
    public function detail_antara_news(Request $request){
        $title = $request->get('title');
        $url = $request->get('url');
        $date = $request->get('date');

        $document = new Document($url, true);
        $summary = $document->find("//p[contains(@class, 'wp-caption-text')]", Query::TYPE_XPATH);
        $content = $document->find("//div[contains(@class, 'post-content')]", Query::TYPE_XPATH);

        for($i = 0; $i < count($summary); $i++){
            $articleCode[] = array(
                'title' => $title,
                'url' => $url,
                'summary' => $summary[$i]->text(),
                'content' => $content[$i]->text(),
                'published_date' => $date
            );
        }
        return view('detail_article_antara_news',['articleCode' => $articleCode]);

    }
    /* digunakan untuk menyimpan data keseluruhan dari html antara news */
    public function generate_save_antara_news(Request $request){
        $document = new Document('https://www.antaranews.com/indeks', true);
        $posts = $document->find("//header//h3//a", Query::TYPE_XPATH);
        for($i = 0; $i < count($posts); $i++) {
            echo $posts[$i]->text(), '<br/>';
            $coba = $posts[$i];
            $data = new \SimpleXMLElement($coba);
            $linkcuyy[$i] = $data['href'];
            echo '<a href'.$linkcuyy[$i].'>'.$linkcuyy[$i].'</a><br/>';
        }
    }
    /* digunakan untuk menampilkan data tribunnews dari rss xml */
    public function index_xpath(Request $request){
        $url = "https://www.tribunnews.com/rss";

        $xml = simplexml_load_file($url);
        // dd($xml->channel->item);
        $data = count($xml->channel->item);
        // dd($data);
        for($i = 0; $i < $data; $i++){
        $document = new Document(strval($xml->channel->item[$i]->link), true);
        $posts = $document->find("//div[contains(@class, 'txt-article')]", Query::TYPE_XPATH);
        for($j = 0; $j < count($posts); $j++){
        $articleCode[] = array(
            'no' => $j + 1,
            'title' => strval($xml->channel->item[$i]->title),
            'url' => strval($xml->channel->item[$i]->link),
            'description' => strval($xml->channel->item[$i]->description),
            'pubdate' => strval($xml->channel->item[$i]->pubDate),
            'content' => $posts[$j]->text()
        );
        }
        }
        return view('index_tribunnews',['articleCode' => $articleCode]);
    }
    /* digunakan untuk menampilkan data antara news dari rss xml */
    public function index_xpath_antara_news(Request $request){
        $url = "https://www.antaranews.com/rss/terkini.xml";

        $xml = simplexml_load_file($url);
        // dd($xml->channel->item);
        $data = count($xml->channel->item);
        // dd($data);
        for($i = 0; $i < 10; $i++){
            $document = new Document(strval($xml->channel->item[$i]->link), true);
            $summary = $document->find("//p[contains(@class, 'wp-caption-text')]", Query::TYPE_XPATH);
            $content = $document->find("//div[contains(@class, 'post-content')]", Query::TYPE_XPATH);
        for($j = 0; $j < count($summary); $j++){
        $articleCode[] = array(
            'title' => strval($xml->channel->item[$i]->title),
            'link' => strval($xml->channel->item[$i]->link),
            'summary' => $summary[$j]->text(),
            'content' => $content[$j]->text(),
            'description' => strval($xml->channel->item[$i]->description),
            'pubdate' => date("d/m/Y", strtotime(strval($xml->channel->item[$i]->pubDate)))
        );
        }
        }
        dd($articleCode);
    }
     /* digunakan untuk menyimpan data tribunnews dari rss xml ke dalam database */
    public function generate_save_xpath_tribunnews(Request $request){
        $url = "https://www.tribunnews.com/rss";

        $xml = simplexml_load_file($url);
        // echo $url."\n";
        // dd($xml->channel->item);
        $data = count($xml->channel->item);
        // dd($data);
        for($i = 0; $i < $data; $i++){
            $document = new Document(strval($xml->channel->item[$i]->link), true);
            $posts = $document->find("//div[contains(@class, 'txt-article')]", Query::TYPE_XPATH);
                for($j = 0; $j < count($posts); $j++){
                $articleselection = Article::where('url','=',strval($xml->channel->item[$i]->link))->first();
                if($articleselection == null){
                    $article = new Article;
                    $article->title = strval($xml->channel->item[$i]->title);
                    $article->url = strval($xml->channel->item[$i]->link);
                    $article->summary = strval($xml->channel->item[$i]->description);
                    $article->published_date = date("Y-m-d", strtotime(strval($xml->channel->item[$i]->pubDate)));
                    $article->content = $posts[$j]->text();
                    $article->save();
                }
            }
        }
        echo "data berhasil disimpan";
    }
         /* digunakan untuk menyimpan data antara news dari rss xml ke dalam database */
    public function generate_save_xpath_antara_news(Request $request){
        $url = "https://www.antaranews.com/rss/terkini.xml";

        $xml = simplexml_load_file($url);
        // dd($xml->channel->item);
        $data = count($xml->channel->item);
        // dd($data);
        for($i = 0; $i < 10; $i++){
            $document = new Document(strval($xml->channel->item[$i]->link), true);
            $summary = $document->find("//p[contains(@class, 'wp-caption-text')]", Query::TYPE_XPATH);
            $content = $document->find("//div[contains(@class, 'post-content')]", Query::TYPE_XPATH);
        for($j = 0; $j < count($summary); $j++){
            $articleselection = Article::where('url','=',strval($xml->channel->item[$i]->link))->first();
            if($articleselection == null){
                $article = new Article;
                $article->title = strval($xml->channel->item[$i]->title);
                $article->url = strval($xml->channel->item[$i]->link);
                $article->summary = $summary[$j]->text();
                $article->content = $content[$j]->text();
                $article->published_date =  date("Y-m-d", strtotime(strval($xml->channel->item[$i]->pubDate)));
                $article->save();
            }
        }
        }
        echo "data berhasil disimpan";
    }
         /* digunakan untuk menyimpan data tribunnews dari rss xml ke dalam database dengan metode command */
    public function generate_save_xpath_tribunnews_crawling(Request $request){
        $url = "https://www.tribunnews.com/rss";

        $xml = simplexml_load_file($url);
        // echo $url."\n";
        // dd($xml->channel->item);
        $data = count($xml->channel->item);
        // dd($data);
        for($i = 0; $i < $data; $i++){
            $document = new Document(strval($xml->channel->item[$i]->link), true);
            $posts = $document->find("//div[contains(@class, 'txt-article')]", Query::TYPE_XPATH);
                for($j = 0; $j < count($posts); $j++){
                $selection = Article::where('url','=',strval($xml->channel->item[$i]->link))->first();
                if($selection == null){
                $article = new Article;
                $article->title = strval($xml->channel->item[$i]->title);
            $article->url = strval($xml->channel->item[$i]->link);
                $article->summary = strval($xml->channel->item[$i]->description);
                $article->published_date = date("Y-m-d", strtotime(strval($xml->channel->item[$i]->pubDate)));
                $article->content = $posts[$j]->text();
                $article->save();
                }
            }
        }
        echo "data berhasil disimpan";
    }
         /* digunakan untuk menyimpan data tribunnews dari rss xml ke dalam database dengan metrode command */
    public function generate_save_xpath_antara_news_crawling(Request $request){
        $url = "https://www.antaranews.com/rss/terkini.xml";

        $xml = simplexml_load_file($url);
        // dd($xml->channel->item);
        $data = count($xml->channel->item);
        // dd($data);
        for($i = 0; $i < 10; $i++){
            $document = new Document(strval($xml->channel->item[$i]->link), true);
            $summary = $document->find("//p[contains(@class, 'wp-caption-text')]", Query::TYPE_XPATH);
            $content = $document->find("//div[contains(@class, 'post-content')]", Query::TYPE_XPATH);
        for($j = 0; $j < count($summary); $j++){
            $selection = Article::where('url','=',strval($xml->channel->item[$i]->link))->first();
            if($selection == null){
            $article = new Article;
            $article->title = strval($xml->channel->item[$i]->title);
            $article->url = strval($xml->channel->item[$i]->link);
            $article->summary = $summary[$j]->text();
            $article->content = $content[$j]->text();
            $article->published_date =  date("Y-m-d", strtotime(strval($xml->channel->item[$i]->pubDate)));
            $article->save();
            }
        }
        }
        echo "data berhasil disimpan";
    }
         /* digunakan untuk menampilkan detail article yang telah tersimpan di database */
    public function detail_article($id){
        $article = Article::where('id','=',$id)->first();
        return view('detail_article',['article' => $article]);
    }
         /* digunakan untuk menampilkan article yang telah tersimpan di database */
    public function index_article(){
        $article = Article::select('title','url','content','summary','published_date')->get();
        $iloveyou3000 = 1;
        foreach($article as $a){
            $dataarticle[] = array(
                'no' => $iloveyou3000++,
                'title' =>  $a->title,
                'url' => $a->url,
                'summary' => $a->summary,
                'pubDate' => $a->published_date,
                'content' => $a->content
            );
        }
        return view('index_article',['dataarticle' => $dataarticle]);
    }
         /* digunakan untuk menghapus article yang telah tersimpan di database */
    public function delete_article(Request $request, $id){
        $article = Article::where('id','=',$id);
        $article->delete();
        return redirect('/article');
    }
}
