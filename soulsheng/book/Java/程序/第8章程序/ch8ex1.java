import java.io.*;
public class ch8ex1{
	public static void main(String[]args){
		File f1=new File("test");
		if(f1.exists()){
			if(f1.canRead())
				System.out.println("test directory can read");
			if(f1.canWrite())
				System.out.println("test directory can write");
			String s1=f1.getAbsolutePath();
			String s2=f1.getName();
			String s3=f1.getPath();
			System.out.println(s1);
			System.out.println(s2);
			System.out.println(s3);
			if(f1.isDirectory()){
				System.out.println("Test Directory File List");
				String files[]=f1.list();
				for(int j=0;j<files.length;j++)
					System.out.println(files[j]);
			}
		}else
			System.out.println("test directory is not exist");
		File f2=new File("E:\\¶¡ÔÀÎ°\\JAVA½Ì²Ä±àÐ´\\µÚ8ÕÂ\\µÚ8ÕÂ³ÌÐò\\test\\ch4ex1.java");
		System.out.println(f2.delete());
	}
}