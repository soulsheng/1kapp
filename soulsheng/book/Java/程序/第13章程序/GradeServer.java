//GradeServer.class
import java.rmi.*;
import java.rmi.server.*;
import sun.applet.*;

public class GradeServer
{
	public static void main(String[] args){
		try{
			System.out.println("Constructing server implementations...");
			//生成远程对象
			GradeImpl p1=new GradeImpl("Zhang 90");
			GradeImpl p2=new GradeImpl("Wang 88");
			
			System.out.println("Binding server implementations to registry...");
			//注册远程对象
			Naming.rebind("Zhang",p1);
			Naming.rebind("Wang",p2);
			
			System.out.println("waiting for invocatons from  clients...");
		}
		catch(Exception e)
		{
			System.out.println("Error:"+e);
		}
 }
}