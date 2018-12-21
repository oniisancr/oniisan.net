<?php

class curlx {
	
 function get($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 不验证https,hosts
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_ENCODING, "");					//解压传送过来的数据

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);					//10秒超时

	$response = curl_exec($ch);
	if ($response  ==null) {
  		echo "网页请求失败,请稍后重试";
			header("refresh:3;url=../index.php");
			print('<br>三秒后将自动跳转到首页');
			exit;
	}
	else {
 		 //$curl_info= curl_getinfo($ch);
		//echo "code： {$curl_info['http_code']}";
	}
	curl_close($ch);	
	return $response;
}

function getFulUrl($url){								//把所有地址补全后的url
	$domain='https://www.xiashu.la';
	$html = $this->get($url);
	$html=preg_replace('/href="/','href="'.$domain,$html);
	return $html;
	
	//preg_match_all('/<div class="title">(.*?)<\/div>/i', $html, $match);
}

function addDomain($content){
	$domain='https://www.xiashu.la';

	$content=preg_replace('/href="/','href="'.$domain,$content);
	return $content;
}



function searchKeyword($keyword,$page){
   // $url = "http://www.baidu.com/s?wd=".$word;
  	 $searchtype='all';
    $url="https://www.xiashu.la/search.html?searchkey=$keyword&searchtype=$searchtype&page=$page";
    //echo $url;
    // 构造包头，模拟浏览器请求
    $header = array (
      "Host:www.xiashu.la",
      "Content-Type:application/x-www-form-urlencoded",//get请求
      "Connection: keep-alive",
      'Referer:http://www.xiashu.la',
      'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'
    );
  //  $data=array( 'searchkey' => $keyword,
    //'searchtype' =>'all',
      //'page'=>$page,
        //  );
    
    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 不验证https,hosts
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_ENCODING, "");					//解压传送过来的数据

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);					//10秒超时
		curl_setopt($ch, CURLOPT_ENCODING, "");					
		
		
	//	$sResult = httpRequest($url, $header, $data);
    
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
   // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $content = curl_exec ( $ch );
    if ($content == FALSE) {
    echo "error:" . curl_error ( $ch );
    }
    curl_close ( $ch );
    
    //输出结果
    return $content;
   /* $this->o_String->string=$content;
    $s_begin='<div id="rs">';
    $s_end='</div>';
    $summary=$this->o_String->getPart($s_begin,$s_end);
    $s_begin='<div class="tt">相关搜索</div><table cellpadding="0"><tr><th>';
    $s_end='</th></tr></table></div>';
    $content=$this->o_String->getPart($s_begin,$s_end);
    return $content;*/
  }





}
//var_dump($match);





?>