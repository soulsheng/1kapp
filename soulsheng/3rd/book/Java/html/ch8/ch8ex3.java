import java.io.*;
public class ch8ex3{
	public static void main(String[]args){
		String t;
		try{
			FileWriter f1=new FileWriter("textdata.txt");
			PrintWriter df=new PrintWriter(f1);
			for(int j=0;j<5;j++){
				for(int i=0;i<2;i++){
					System.out.print("Enter a string:");
					t=Keyboard.readString();
					df.print(t);
				}
				df.print("\r\n");
			}
			df.close();
		}catch(Exception e){
			e.printStackTrace();
		}
	}
}					