//sqlBean.java
package webretail;
import java.sql.*;
import java.io.*;
import com.microsoft.jdbc.sqlserver.*;
//import  com.microsoft.
public class sqlBean
{
//url���Ա�ʾ����Դ�������ַ
private static String url="jdbc:Microsoft:SQLserver://xmlws:1433;databaseName=Retail";
//��ʾ���ú���JDBC��������
private static String driver="com.microsoft.jdbc.sqlserver.SQLServerDriver";
//���ݿ����Ӻ�����
private static Connection conn;
private static Statement comm;
//���ؽ����ɢ��
private static ResultSet rs;

//ע��JDBC����
public static void regDriver()//register JDBC driver
{try
  {Class.forName(driver).newInstance();
     // System.out.println("Instance successful!");
    }
  catch(Exception e)
  {System.out.println("�޷�������������ʵ��!");}

}
//�������ݿ�����
public static void conBuild()//build the connection of JDBC
{
  try{
sqlBean.regDriver();
conn=DriverManager.getConnection(url,"sa","sa");
conn.setAutoCommit(true);
}
catch(Exception e)
{ System.out.println(e.getMessage()) ;
  System.out.println("�޷��������ݿ�Connection!");}
}
//ִ�в�ѯ���
public static ResultSet execQuery(String stmt)//execute query statement
{
try
  {sqlBean.conBuild();
    comm=conn.createStatement();
   rs=comm.executeQuery(stmt);
   return rs;
}
catch(Exception e)
{
System.out.println("�޷�����Statement!");return null;
}
}
//ִ�и������
public static void execUpdate(String UpdateString){
try{
   sqlBean.conBuild();
   comm=conn.createStatement();
   comm.executeUpdate(UpdateString);
   }catch(Exception e){e.getMessage();}
}
//�Ͽ����ݿ�����
public static void closeDB(){
   try{
   comm.close();
   conn.close();}catch(Exception e)
 {System.out.println(e.getMessage());}
}

public static void main(String[] args)throws Exception{
 ResultSet rst=sqlBean.execQuery("Select * from sales_table");
 while(rst.next()){
   System.out.println(rst.getString(1));
 }
 }

 }
