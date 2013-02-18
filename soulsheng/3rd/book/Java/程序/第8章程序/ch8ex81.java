import java.io.*;
public class ch8ex81{
	public static void main(String[]args){
		try{
			DataOutputStream fout=new DataOutputStream(new FileOutputStream("ch8ex8.dat"));
			for(int j=0;j<10;j++){
				fout.writeInt(j);
				fout.writeChar((char)(j+65));
				fout.writeDouble(j*12.5);
				fout.writeBoolean(true);
				fout.writeUTF("The example for DataOutputStream class");
			}
			fout.close();
		}catch(Exception e){
			e.printStackTrace();
		}
	}
}		