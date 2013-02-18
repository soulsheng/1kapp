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
       //��ȡ��������ַ
       InetAddress address = InetAddress.getByName(host);
       System.out.println("Sending service request to " + address);
       //���ɷ��ͷ�����������ݱ�
       DatagramPacket p = 
           new DatagramPacket(msg, msg.length, 
                   address, TIME_PORT);
       DatagramSocket skt = new DatagramSocket();
       //���ͷ�������
       skt.send(p);
       //���ɽ��շ����������������ݱ�
       p= new DatagramPacket(msg, msg.length);
       //�������ݱ�
       skt.receive(p);
       //��ӡ���յ�������
       String time = new String(p.getData());
       System.out.println("The time at "+host + " is:" + time);
       //�ر�����
       skt.close();
     }
   }

