import java.io.*;
public class ch8ex91{
	public static void main(String[]args){
		int x;
		try{
			DataOutputStream fout=new DataOutputStream(new FileOutputStream("grades.dat"));
			for(int j=0;j<150;j++){
				x=(int)(Math.random()*1000000)%100;
				fout.writeInt(x);
			}
			fout.close();
		}catch(Exception e){
			e.printStackTrace();
		}
	}
}