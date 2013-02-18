//Grade.java
import java.rmi.*;

public interface Grade extends Remote
{
	String getDescription()throws RemoteException;
}