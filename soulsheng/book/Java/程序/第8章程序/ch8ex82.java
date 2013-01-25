import java.io.*;
public class ch8ex82{
	public static void main(String[]args){
		try{
			DataInputStream fin=new DataInputStream(new FileInputStream("ch8ex8.dat"));
			for(int j=0;j<10;j++){
				int x=fin.readInt();
				char c=fin.readChar();
				double d=fin.readDouble();
				boolean b=fin.readBoolean();
				String s=fin.readUTF();
				System.out.print(x+"  ");
				System.out.print(c+"  ");
				System.out.print(d+"  ");
				System.out.print(b+"  ");
				System.out.print(s);
				System.out.println();
			}
			fin.close();
		}catch(Exception e){
			e.printStackTrace();
		}
	}
}