import java.io.*;
import java.util.*;
import java.text.*;
public class ch8ex2{
	public static void main(String[]args){
		File f1=new File("ch8ex1.class");
		if(f1.exists()){
			//显示文件属性
			String lo=f1.getAbsolutePath();
			System.out.println("The location is :"+lo);
			long len=f1.length();
			System.out.println("Size is : "+len);
			long mo=f1.lastModified();
			Date d=new Date(mo);
			DateFormat df=DateFormat.getDateTimeInstance(DateFormat.DEFAULT,DateFormat.DEFAULT);
			String fDate=df.format(d);
			System.out.println("Last Modified :"+fDate);
			System.out.print("The attributes: ");
			if(f1.canRead())
				System.out.println("  can read");
			if(f1.canWrite())
				System.out.println("  can write");
			if(f1.isHidden())
				System.out.println("  is hidden");
			//修改文件属性
			f1.setLastModified(mo+1000);
			f1.setReadOnly();
		}else
			System.out.println("ch8ex1.class file is not exist");
	}
}