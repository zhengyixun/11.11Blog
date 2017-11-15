<?php
class pages{
    public  $nums=10;
    public  $total=0;
    public  $pageNum;
    public  $limit;
    function show(){

        $this->pageNum=ceil($this->total/$this->nums);
        $originUrl=PAGE_URL;
        if(!strrpos($originUrl,"pages")){
            $originUrl=$originUrl."&pages=0";

        }
        $fullUrl=substr($originUrl,0,strrpos($originUrl,"&pages"));
        $pages=substr($originUrl,strrpos($originUrl,"=")+1);

        $str="";
        $str.="<a href='{$fullUrl}&pages=0'>[首页]</a>";


        $up=$pages-1<0?0:$pages-1;

        $str.="<a href='{$fullUrl}&pages={$up}'>[上一页]</a>";

        $pageNums=$this->pageNum;

        $start=$pages-3<0?0:$pages-3;

        $end=$pages+6>$pageNums-1?$pageNums-1:$pages+6;



        for($i=$start;$i<=$end;$i++){
            $num=$i+1;
            if($i==$pages){
                $style="style='color:red'";
            }else{
                $style="style='color:#000'";
            }
            $str.="<a href='{$fullUrl}&pages={$i}' {$style}>[{$num}]</a>";
        }

        $next=$pages+1>$pageNums-1?$pageNums-1:$pages+1;
        $str.="<a href='{$fullUrl}&pages={$next}'>[下一页]</a>";

        $last=$pageNums-1;
        $str.="<a href='{$fullUrl}&pages={$last}'>[尾页]</a>";

        $nums=$pages*$this->nums;
        $this->limit=$nums.", ".$this->nums;
        return $str;
    }

}