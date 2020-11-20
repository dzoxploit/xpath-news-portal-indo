<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use DiDom\Document;
use DiDom\Query;
use Carbon\Carbon;
class Liputan6comController extends Controller
{
    public function index_liputan6(Request $request){
        $pagination = $request->get('page');
        $tanggal = Carbon::now()->format('yy/m/d');
        $url = 'https://www.liputan6.com/indeks/'.$tanggal.'/';
        $document = new Document($url, true);
        $posts = $document->find("//article[contains(@class,'articles--rows--item')]", Query::TYPE_XPATH);
        for($i = 0; $i < count($posts); $i++) {
            $data_link = $posts[$i]->find("//aside[contains(@class,'articles--rows--item__details')]//a[contains(@class, 'articles--rows--item__title-link')]",Query::TYPE_XPATH);
            $data = new \SimpleXMLElement($data_link[0]);
            $linkcuyy = $data['href'];
            $data_title = $posts[$i]->find("//aside[contains(@class,'articles--rows--item__details')]//span[contains(@class, 'articles--rows--item__title-link-text')]",Query::TYPE_XPATH);
            $image = $posts[$i]->find("//source", Query::TYPE_XPATH);
            $data_summary = $posts[$i]->find("//aside[contains(@class,'articles--rows--item__details')]//div[contains(@class, 'articles--rows--item__summary')]",Query::TYPE_XPATH);
            $article[] = array(
                'no' => $i + 1,
                'image' => strval($image[0]),
                'summary' => $data_summary[0]->text(),
                'title' => $data_title[0]->text(),
                'url' => strval($linkcuyy),
                'date' => Carbon::now()->format('Y-m-d')
            );
        }
        return view('index_liputan6',['article' => $article]);
    }
}
