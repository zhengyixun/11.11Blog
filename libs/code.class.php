<?php
class code{
    //属性  方法
    public $img;
    public $width=100;
    public $height=54;
    public $getColor='';
    public $zhongzi='23456789abcdefghgklABCDEFGHGKLMNOPQRSTUVWXYZ';
    public $current='';        //内容
    public $size=array("min"=>30,"max"=>37);   //设置字体大小
    public $angle=array("min"=>-10,"max"=>10);  //设置字体倾斜角度
    public $codeUrl;
    public $codeLen=4;
    public $lineNum=array("min"=>3,"max"=>10);  //线条数
    public $pixNum=array("min"=>50,"max"=>200); //点数
    public $type='png'; //图片类型
    //设置背景色
    private function getColor($type='back'){
        $r=$type=='back'?mt_rand(0,120):mt_rand(130,255);
        $g=$type=='back'?mt_rand(0,120):mt_rand(130,255);
        $b=$type=='back'?mt_rand(0,120):mt_rand(130,255);
        return imagecolorallocate($this->img,$r,$g,$b);
    }
    //创建画布
    private function createCanvas(){
        $this->img=imagecreatetruecolor($this->width,$this->height); //创建资源
        imagefill($this->img,0,0,$this->getColor('back'));
    }
    //创建
    private function createText(){
        //生成4位随机数
        $str='';
        for($i=0;$i<$this->codeLen;$i++){
            $str.=$this->zhongzi[mt_rand(0,strlen($this->zhongzi)-1)];
        }
        $this->current=$str;
        return $str;
    }
    //创建文字
    private function createCon(){
        $this->createText();
        //内容
        $fontsize=mt_rand($this->size["min"],$this->size["max"]);
        $fontangle=mt_rand($this->angle["min"],$this->angle["max"]);
        for($j=0;$j<$this->codeLen;$j++){
            $box= imagettfbbox($fontsize, $fontangle, $this->codeUrl, $this->current[$j]);

            $xx=$j*($this->width/$this->codeLen)+mt_rand(-10,10);
            if($j==0){
                $xx=$xx<0?0:$xx;
            }
            $height=$box[1]-$box[5];
            $y=$box[1]-$box[5]+mt_rand(-10,20);

            $y=$y<$height?$height:$y;


            imagettftext($this->img,$fontsize,$fontangle,$xx,$y,$this->getColor('l'),$this->codeUrl,$this->current[$j]);
        }
    }
    //创建随机线条
    private function createLine(){
        $lineNum=mt_rand($this->lineNum['min'],$this->lineNum['max']);
        for($i=0;$i<$lineNum;$i++){
            imageline($this->img,mt_rand(0,$this->width/3),mt_rand(0,$this->height),mt_rand($this->width/2,$this->width),mt_rand(0,$this->height),$this->getColor());
        }
    }
    //创建随机点
    private function createPix(){
        $pixNum=mt_rand($this->pixNum['min'],$this->pixNum['max']);
        for($i=0;$i<$pixNum;$i++){
            imagesetpixel($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),$this->getColor('l'));
        }
    }

    public function createCode(){
        header("content-type:image/".$this->type);
        //1. 创建画布
        $this->createCanvas();
        //2.  创建文字
        $this->createCon();
        //3.  创建干扰的线
        $this->createLine();
        //4.  创建干扰点
        $this->createPix();

        $type="image".$this->type;
        $type($this->img);       //imagepng($img);
        //转换成小写
        $this->current=strtolower($this->current);
        $_SESSION['code']=$this->current;
        imagedestroy($this->img);   //销毁一个图像
    }
}
//$obj=new code();
//$obj->codeUrl = "demo.ttf";
//$obj->createCode();
