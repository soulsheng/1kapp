//GradeClient.java
import java.rmi.*;
import java.rmi.server.*;

public class GradeClient
{
	public static void main(String[] args){
	//设置RMI安全性管理器
		System.setSecurityManager(new RMISecurityManager());
	//服务器地址
		String url1="rmi://localhost/";
        try{
        //查找和调用远程对象
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