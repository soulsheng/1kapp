import java.io.*;
public class ch8ex92{
	public static void main(String[]args){
		int fail=0;	int pass=0;
		int levelA=0;int levelB=0;
		int levelC=0;int x;
		try{
			DataInputStream fin=new DataInputStream(new FileInputStream("grades.dat"));
			while(fin.available()>0){
				x=fin.readInt();
				if(x<60) fail++;
				else if(x>=60&&x<70) pass++;
					else if(x>=70&&x<80) levelC++;
						else if(x>=80&&x<90) levelB++;
							else levelA++;
			}
			fin.close();
		}catch(Exception e){
			e.printStackTrace();
		}
		System.out.println("Class A level:  "+levelA);
		System.out.println("Class B level:  "+levelB);
		System.out.println("Class C level:  "+levelC);
		System.out.println("Pass:  "+pass);
		System.out.println("Fail:  "+fail);
	}
}