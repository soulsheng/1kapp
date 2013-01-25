import java.io.*;
public class ch8ex4{
	public static void main(String[]args){
		String t;
		PrintWriter df=null;
		try{
			df=new PrintWriter(new FileWriter("textdata.txt"));
		}catch(Exception e){
			e.printStackTrace();
		}
		for(int j=0;j<5;j++){
			for(int i=0;i<2;i++){
				System.out.print("Enter a string:");
				t=Keyboard.readString();
				df.print(t);
			}
			df.print("\r\n");
		}
		df.close();
	}
}