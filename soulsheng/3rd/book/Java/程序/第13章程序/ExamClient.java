//ExamClient.java
import java.net.*;
import java.io.*;

public class ExamClient{
 static Socket svr;
 
 public static void main(String[] args)throws Exception{
  System.out.println("�������ӷ�����,���Ժ�...");
  //��ָ����ַ�ķ�����������
  svr=new Socket(InetAddress.getLocalHost(),3300);
  if (svr!=null)
  System.out.println("��"+svr.getInetAddress()+"���ӳɹ�!�����Ҫ���͵���Ϣ...");
   //����I/O��
  BufferedReader in=new BufferedReader(new InputStreamReader(svr.getInputStream()));
  PrintWriter out=new PrintWriter(svr.getOutputStream());
  BufferedReader wt=new BufferedReader(new InputStreamReader(System.in));
  //�������������Ϣ,�����շ�����Ϣ
  while(true){
   
   String str=wt.readLine();
   out.println(str);
   out.flush();
   if(str.equals("bye")){
   	//�ر�����/�����
   	in.close();
   	out.close();
    break;
   }
   System.out.println(in.readLine());
  }
  //�ر�socket
  svr.close();
 }
}

