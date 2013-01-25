import java.io.*;
public class ch8ex14{
	public static void main(String[]args){
		try{
			BufferedReader bIn=new BufferedReader(new InputStreamReader(System.in));
			String buffer;
			int i;long l;float f;double d;boolean b;
			System.out.print("Enter a integer numbers :");
			i=Integer.parseInt(bIn.readLine());
			System.out.print("Enter a long integer numbers :");
			l=Long.parseLong(bIn.readLine());
			System.out.print("Enter a floating point numbers :");
			f=Float.parseFloat(bIn.readLine());
			System.out.print("Enter a double floating point numbers :");
			d=Double.parseDouble(bIn.readLine());
			System.out.print("Enter a boolean numbers :");
			b=new Boolean(bIn.readLine()).booleanValue();
			System.out.print("Integer :"+i);
			System.out.print("     Long Integer :"+l);
			System.out.println("     Float :"+f);
			System.out.print("Double Float :"+d);
			System.out.println("     Boolean :"+b);
		}catch(Exception e){e.printStackTrace();}
	}
}