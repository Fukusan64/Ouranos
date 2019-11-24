<?php

namespace App\Http\Controllers;

use App\Idol;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        // Inputの確認
        $name       /* 名前      */ = $request->input('name',false);
        $birthplace /* 出身地    */ = $request->input('birthplace',false);
        $month      /* 誕生日-月 */ = $request->input('month',false);
        $day        /* 誕生日-日 */ = $request->input('day',false);
        $age        /* 年齢      */ = $request->input('age',false);
        $range      /* 年齢範囲  */ = $request->input('range',false);

        // 日付のみ指定で両方未定義ならキレる
        if($month === 'u' && $day === 'u' && !($name||$birthplace||$age||$range)){
            abort(400,'月か日どちらかは指定してください');
        }
        // 日付未定義の場合false扱いにする
        $month = $month !== 'u' ? $month : false;
        $day = $day !== 'u' ? $day : false;

        if(!($name||$birthplace||$month||$day||$age||$range)){
            // 条件未入力なので検索開始画面を出す
            return view('search.index');
        }

        // 検索開始
        $search = Idol::select();
        $query_info = array();
        $order_by = "id";
        $order_direction = "asc";
        if($name){ // 名前
            $name_flag = (bool)preg_match("/^([ぁ-ゞ]|[ァ-ヴ])+$/u", $name);
            $search = $search->where($name_flag ? 'name_y' : 'name' ,'like',"%{$name}%");
            $query_info[0] = array('type' => $name_flag ? 'Hiragana' : 'Name', 'value' => $name);
        }
        if($birthplace){ // 出身地
            switch($birthplace){
                case "東北":
                    $ar = array("青森県","秋田県","岩手県","宮城県","福島県","山形県");
                    break;
                case "関東":
                    $ar = array("東京都","神奈川県","千葉県","埼玉県","神奈川県","茨城県","栃木県","群馬県");
                    break;
                case "中部":
                    $ar = array("新潟県","富山県","石川県","福井県","山梨県","長野県","岐阜県","静岡県","愛知県");
                    break;
                case "近畿":
                    $ar = array("大阪府","兵庫県","京都府","滋賀県","奈良県","和歌山県","三重県","京都府？");
                    break;
                case "中国":
                    $ar = array("鳥取県","島根県","岡山県","広島県","山口県");
                    break;
                case "四国":
                    $ar = array("香川県","徳島県","愛媛県","高知県");
                    break;
                case "九州沖縄":
                    $ar = array("福岡県","佐賀県","長崎県","熊本県","大分県","宮崎県","鹿児島県","沖縄県");
                    break;
                case "海外":
                    $ar = array("イギリス","ブラジル");
                    break;
                default:
                    $ar = array($birthplace);
            }
            $search = $search->whereIn('birthplace',$ar);
            $query_info[1] = array('type' => 'Birthplace', 'value' => $birthplace);
        }
        if($month){ //誕生日 - 月
            $search = $search->whereRaw('MONTH(birthdate) = ?',[$month]);
            $order_by = "birthdate";
            $query_info[2] = array('type' => 'Birthdate','value' => $month.'月生まれ');
        }
        if($day){ // 誕生日 - 日
            $search = $search->whereRaw('DAY(birthdate) = ?',[$day]);
            $order_by = "birthdate";
            $query_info[2] = array('type' => 'Birthdate','value' => $day.'日生まれ');
        }
        if($month && $day){
            $query_info[2] = array('type' => 'Birthdate','value' => $month.'月'.$day.'日生まれ');
        }
        if($age){
            if(!$range) abort(400,'年齢の検索範囲指定がありません');
            switch ($range){
                case 'equal':
                    $range_op = '=';  $range_info = '歳である'; break;
                case 'higher':
                    $range_op = '>='; $range_info = '歳以上'; $order_direction = 'asc'; break;
                case 'lower':
                    $range_op = '<='; $range_info = '歳以下'; $order_direction = 'desc';  break;
                default:
                    abort(400,'年齢の範囲指定が正しくありません');
            }
            $order_by = 'age';
            $search = $search->where('age',$range_op,$age);
            $query_info[3] = array('type' => 'Age','value' => $age.$range_info);
        }
        $search = $search->orderBy($order_by,$order_direction)->get();
        $search_count = $search->count();
        if($search_count === 1 && $name && !($birthplace||$month||$day||$age||$range)){
            return redirect('/idol/'.$search[0]->name_r)->with('flash_message','リダイレクト:検索結果が1件でした');
        }else{
            return view('search.result',compact('search','query_info','search_count'));
        }
    }
}
