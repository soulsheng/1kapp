//ExamServer.java
import java.io.*;
import java.net.*;

public class ExamServer {
 public static void main(String[] args) throws IOException{
 //�����������׽���
  ServerSocket svr=new ServerSocket(3300);
  System.out.println("�ȴ�����....");
 //�ȴ��ͻ�������
  Socket clt=svr.accept();
 //��ÿͻ�IP��ַ
  System.out.println("������������:"+clt.getInetAddress());
  //����I/O��
  BufferedReader in=new BufferedReader(new InputStreamReader(clt.getInputStream()));
  PrintWriter out=new PrintWriter(clt.getOutputStream());
  //���տͻ�����������Ϣ,������
  while(true){
    String str=in.readLine();
    System.out.println(str);
     out.println("���������յ������͵�:"+str);
     out.flush();
    if(str.equals("bye")){
  //�ر�����/�����
    in.close();
    out.close();
    break;
	}
   }
  //�ر�socket
  clt.close();
 } 
}

