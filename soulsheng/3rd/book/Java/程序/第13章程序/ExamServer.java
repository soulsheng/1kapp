//ExamServer.java
import java.io.*;
import java.net.*;

public class ExamServer {
 public static void main(String[] args) throws IOException{
 //建立服务器套节字
  ServerSocket svr=new ServerSocket(3300);
  System.out.println("等待连接....");
 //等待客户机接入
  Socket clt=svr.accept();
 //获得客户IP地址
  System.out.println("连接请求来自:"+clt.getInetAddress());
  //建立I/O流
  BufferedReader in=new BufferedReader(new InputStreamReader(clt.getInputStream()));
  PrintWriter out=new PrintWriter(clt.getOutputStream());
  //接收客户传送来的信息,并反馈
  while(true){
    String str=in.readLine();
    System.out.println(str);
     out.println("服务器已收到您发送的:"+str);
     out.flush();
    if(str.equals("bye")){
  //关闭输入/输出流
    in.close();
    out.close();
    break;
	}
   }
  //关闭socket
  clt.close();
 } 
}

