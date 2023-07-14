<?php
class paginate {
	public $toplam;
	public $sayfa_basina;
	public $sayfa_sayisi;
	public $baslangic;
	public $ilerigeri;
	public $ilkson;
	public $sayfa;
	public $type;
	private $set;
	
	function __construct() {
		$this->sayfa_basina=10;
		$this->baslangic='0,10';
		$this->ilerigeri=true;
		$this->ilkson=true;
		$this->sayfa=1;
		$this->type=0;
		$this->set=false;
	}
	
	function hazirla() {
		$this->sayfa=$this->sayfa < 1 ? 1 :$this->sayfa;
		$this->sayfa_sayisi=ceil($this->toplam/$this->sayfa_basina);
		$this->baslangic=(($this->sayfa-1)*$this->sayfa_basina);
		$this->set=true;
	}

		function link($VAL)
{
if($this->type==0){
if(strstr($_SERVER['REQUEST_URI'],"sayfa")){
$url=preg_replace("/sayfa=[0-9]+/", "sayfa=".$VAL, $_SERVER[REQUEST_URI]);
}else{
if(strstr($_SERVER['REQUEST_URI'],"?")){
$seperator="&";
}else{
$seperator="?";
}
$url=$_SERVER['REQUEST_URI'].$seperator."sayfa=".$VAL;
}
}elseif($this->type==3){
$cur_pg=$_SERVER['REQUEST_URI'];
$current_pg=explode("/",$cur_pg);
$new_url=str_replace($current_pg[3],"",$cur_pg);
$url=$new_url.$VAL;
}else{
$cur_pg=str_replace("/","",$_SERVER['REQUEST_URI']);
$current_pg=explode("-",$cur_pg);
$new_url=str_replace($current_pg[0]."-","",$cur_pg);
$url=$VAL."-".$new_url;
}
return $url;
}
	
	function sayfala() {
		if($this->set==false) $this->hazirla();
		
		$ilk_sayfa=$this->sayfa-5;
		$son_sayfa=$this->sayfa+5;
		if($this->ilkson==true){
			$ilk_link='<li><a href="'.$this->link(1).'">&laquo;</a></li>';
			$son_link='<li><a href="'.$this->link($this->sayfa_sayisi).'">&raquo;</a></li>';
		} else $ilk_link=$son_link='';

		
		if($ilk_sayfa <=1 ){$ilk_sayfa=1;$ilk_link='';}
		if($son_sayfa >= $this->sayfa_sayisi ){$son_sayfa=$this->sayfa_sayisi;$son_link=' ';}
		
		$sayfalar.=$ilk_link;
		for($i=$ilk_sayfa;$i<=$son_sayfa;$i++){
		if($this->sayfa==$i){
			$class='active';
			}else{
			$class="";
			}
			$sayfalar.='<li class="'.$class.'"><a href="'.$this->link($i).'">'.$i.'</a></li>';
		}
		$sayfalar.=$son_link;
		return $sayfalar;
	}
}
?>