<?php
class Imageadmin
{
	
 
  public function imageupload()
	
    { 

 date_default_timezone_set("Asia/Shanghai"); //����ʱ��
$code = $_FILES['file'];//��ȡС��������ͼƬ
if(is_uploaded_file($_FILES['file']['tmp_name'])) {  
    //���ļ�ת�浽��ϣ����Ŀ¼����Ҫʹ��copy������  
    $uploaded_file=$_FILES['file']['tmp_name'];  
    $username =iconv("utf-8","gb2312",$_POST["user"]);
	
	$cloud=iconv("utf-8","gb2312",$_POST["cloud"]);

    //���Ǹ�ÿ���û���̬�Ĵ���һ���ļ���  
    $user_path=$username;  
    //�жϸ��û��ļ����Ƿ��Ѿ�������ļ���  
    if(!file_exists($user_path)) {  
        mkdir($user_path);  
	
    }  
	$user_path =iconv("gb2312","utf-8",$user_path);
	$cloud=iconv("gb2312","utf-8",$cloud);
    //$move_to_file=$user_path."/".$_FILES['file']['name'];  
    $file_true_name=$_FILES['file']['name'];  
    $move_to_file=$user_path."/".$cloud;

//.substr($file_true_name,strrpos($file_true_name,"."));//strrops($file_true,".")���ҡ�.�����ַ��������һ�γ��ֵ�λ��  
    //echo "$uploaded_file   $move_to_file";  
    if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
        echo $_FILES['file']['name']."--�ϴ��ɹ�".date("Y-m-d H:i:sa"); 
 
    } else {  
        echo "�ϴ�ʧ��".date("Y-m-d H:i:sa"); 
 
    }  
} else {  
    echo "�ϴ�ʧ��".date("Y-m-d H:i:sa");  
}  
 
 


 


    }
    public function upload()
    {
        //���ֻ�ȡ
        $wxid=$_POST["wxid"];
        //ʱ���ȡ
        $diaryTime=$_POST["diaryTime"];
        //ƴ�Ӵ洢����
        $diaryTime=substr($diaryTime,0,10).substr($diaryTime,11,2).substr($diaryTime,14,2).substr($diaryTime,17);
        //�õ��洢����
        $file_name=$wxid.'_'.$diaryTime.'.png';
        //�洢·��
        $path='./picture/'.$file_name;
        //����
        move_uploaded_file($_FILES['picture']['tmp_name'], $path);

    }
	
	 public function onnn(){
		echo "Hello World!";
	

	}
}
	$mytest=new Imageadmin;
	$mytest->imageupload();
	$mytest->onnn();
?>