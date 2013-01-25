//GradeImpl.java
import java.rmi.*;
import java.rmi.server.*;

public class GradeImpl extends UnicastRemoteObject implements Grade
{
	public GradeImpl(String g) throws RemoteException
	{gd=g;}
	public String getDescription(){
		return gd;
	}
	private String gd;
}
