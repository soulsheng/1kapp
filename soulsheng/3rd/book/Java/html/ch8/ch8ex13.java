import java.io.*;
public class ch8ex13{
	public static void main(String[]args){
		char ch;
		System.out.print("Enter a string  :");
		try{
			ch=(char)System.in.read();
			int counter=System.in.available();
			for(int j=1;j<counter;j++){
				System.out.println("In your input "+j+"th character is :"+ch);
				ch=(char)System.in.read();
			}
		}catch(Exception e){System.out.println(e.getMessage());}
	}
}