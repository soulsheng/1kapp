//TimeClient.java
import java.io.*;
import java.net.*;

   public class TimeClient{
     final static int TIME_PORT = 1100;
     public static void main(String args[]) throws 
             IOException {
       if (args.length == 0) {
         System.err.println
             ("Not specify server name!");
         System.exit(-1);
       }
       String host = args[0];
       byte msg[] = new byte[256];
       //获取服务器地址
       InetAddress address = InetAddress.getByName(host);
       System.out.println("Sending service request to " + address);
       //生成发送服务请求的数据报
       DatagramPacket p = 
           new DatagramPacket(msg, msg.length, 
                   address, TIME_PORT);
       DatagramSocket skt = new DatagramSocket();
       //发送服务请求
       skt.send(p);
       //生成接收服务器发送来的数据报
       p= new DatagramPacket(msg, msg.length);
       //接收数据报
       skt.receive(p);
       //打印接收到的数据
       String time = new String(p.getData());
       System.out.println("The time at "+host + " is:" + time);
       //关闭连接
       skt.close();
     }
   }

