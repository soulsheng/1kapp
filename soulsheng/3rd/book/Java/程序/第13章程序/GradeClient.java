//GradeClient.java
import java.rmi.*;
import java.rmi.server.*;

public class GradeClient
{
	public static void main(String[] args){
	//����RMI��ȫ�Թ�����
		System.setSecurityManager(new RMISecurityManager());
	//��������ַ
		String url1="rmi://localhost/";
        try{
        //���Һ͵���Զ�̶���
        	Grade c1=(Grade)Naming.lookup(url1+"Zhang");
        	Grade c2=(Grade)Naming.lookup(url1+"Wang");
        	System.out.println(c1.getDescription());
        	System.out.println(c2.getDescription());
        }catch(Exception e)
        {
        	System.out.println("Error: "+e);
        }
    }
}