//SqlDB.java
import java.sql.*;
import java.io.*;
import com.microsoft.jdbc.sqlserver.*;
//import  com.microsoft.
public class SqlDB
{
//url用以表示数据源的网络地址
private static String url="jdbc:Microsoft:SQLserver://xmlws:1433;databaseName=Retail";
//表示采用何种JDBC驱动程序
private static String driver="com.microsoft.jdbc.sqlserver.SQLServerDriver";
//数据库连接和声明
private static Connection conn;
private static Statement comm;
//返回结果集散地
private static ResultSet rs;

//注册JDBC驱动
public static void regDriver()//register JDBC driver
{try
  {Class.forName(driver).newInstance();
     // System.out.println("Instance successful!");
    }
  catch(Exception e)
  {System.out.println("无法创建驱动程序实体!");}

}
//建立数据库连接
public static void conBuild()//build the connection of JDBC
{
  try{
SqlDB.regDriver();
conn=DriverManager.getConnection(url,"sa","sa");
conn.setAutoCommit(true);
}
catch(Exception e)
{ System.out.println(e.getMessage()) ;
  System.out.println("无法连接数据库Connection!");}
}
//执行查询语句
public static ResultSet execQuery(String stmt)//execute query statement
{
try
  {SqlDB.conBuild();
    comm=conn.createStatement();
   rs=comm.executeQuery(stmt);
   return rs;
}
catch(Exception e)
{
System.out.println("无法创建Statement!");return null;
}
}
//执行更新语句
public static void execUpdate(String UpdateString){
try{
   SqlDB.conBuild();
   comm=conn.createStatement();
   comm.executeUpdate(UpdateString);
   }catch(Exception e){e.getMessage();}
}
//断开数据库连接
public static void closeDB(){
   try{
   comm.close();
   conn.close();}catch(Exception e)
 {System.out.println(e.getMessage());}

 }
}
