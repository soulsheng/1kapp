	//TimeServer.java
	import java.io.*;
	import java.net.*;
	import java.util.*;

	public class TimeServer {
		final static int TIME_PORT = 1100;
		public static void main(String args[]) throws 
             	IOException {
     //在指定端口上创建一个DatagramSocket对象
      	 DatagramSocket skt = new DatagramSocket(TIME_PORT);
       		while (true) {
         byte buffer[] = new byte[256];
     //创建一个数据报用以接到客户的服务请求
         DatagramPacket p = 
             new DatagramPacket(buffer, buffer.length);
     //等待请求服务的数据报
         skt.receive(p);
     //获得系统时间
         String date = new Date().toString();
         buffer = date.getBytes();
     //获取请求服务方的网络地址和端口
         InetAddress address = p.getAddress();
         int port = p.getPort();
     //生成发送数据报对象
         p = new DatagramPacket(buffer, buffer.length, 
                 address, port);
     //发送数据报
         skt.send(p);
       }
     }
   }

