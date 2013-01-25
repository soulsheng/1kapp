import java.io.*;
public class ch8ex5{
	public static void main(String[]args){
		String t;
		try{
			FileReader f1=new FileReader("ch8ex3.java");
			BufferedReader df=new BufferedReader(f1);
			t=df.readLine();
			while(t!=null){
				System.out.println(t);
				t=df.readLine();
			}			
			df.close();
		}catch(IOException e){
			System.out.println(e.getMessage());
		}
	}
}	