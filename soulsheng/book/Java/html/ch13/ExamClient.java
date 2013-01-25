//ExamClient.java
import java.net.*;
import java.io.*;

public class ExamClient{
 static Socket svr;
 
 public static void main(String[] args)throws Exception{
  System.out.println("正在连接服务器,请稍候...");
  //与指定地址的服务器相连接
  svr=new Socket(InetAddress.getLocalHost(),3300);
  if (svr!=null)
  System.out.println("与"+svr.getInetAddress()+"连接成功!请输出要传送的信息...");
   //建立I/O流
  BufferedReader in=new BufferedReader(new InputStreamReader(svr.getInputStream()));
  PrintWriter out=new PrintWriter(svr.getOutputStream());
  BufferedReader wt=new BufferedReader(new InputStreamReader(System.in));
  //向服务器发送信息,并接收反馈信息
  while(true){
   
   String str=wt.readLine();
   out.println(str);
   out.flush();
   if(str.equals("bye")){
   	//关闭输入/输出流
   	in.close();
   	out.close();
    break;
   }
   System.out.println(in.readLine());
  }
  //关闭socket
  svr.close();
 }
}

