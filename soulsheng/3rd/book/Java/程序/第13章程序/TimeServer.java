	//TimeServer.java
	import java.io.*;
	import java.net.*;
	import java.util.*;

	public class TimeServer {
		final static int TIME_PORT = 1100;
		public static void main(String args[]) throws 
             	IOException {
     //��ָ���˿��ϴ���һ��DatagramSocket����
      	 DatagramSocket skt = new DatagramSocket(TIME_PORT);
       		while (true) {
         byte buffer[] = new byte[256];
     //����һ�����ݱ����Խӵ��ͻ��ķ�������
         DatagramPacket p = 
             new DatagramPacket(buffer, buffer.length);
     //�ȴ������������ݱ�
         skt.receive(p);
     //���ϵͳʱ��
         String date = new Date().toString();
         buffer = date.getBytes();
     //��ȡ������񷽵������ַ�Ͷ˿�
         InetAddress address = p.getAddress();
         int port = p.getPort();
     //���ɷ������ݱ�����
         p = new DatagramPacket(buffer, buffer.length, 
                 address, port);
     //�������ݱ�
         skt.send(p);
       }
     }
   }

