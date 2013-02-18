import java.io.*;
public class ch8ex10{
	public static void main(String[]args){
		int x;
		try{
			DataOutputStream fout=new DataOutputStream(new FileOutputStream("grades.dat",true));
			for(int j=0;j<200;j++){
				x=(int)(Math.random()*1000000)%100;
				fout.writeInt(x);
			}
			fout.close();
		}catch(Exception e){
			e.printStackTrace();
		}
		int fail=0;	int pass=0;
		int levelA=0;int levelB=0;
		int levelC=0;
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
		try{
			DataInputStream fin=new DataInputStream(new FileInputStream("grades.dat"));
			DataOutputStream fout1=new DataOutputStream(new FileOutputStream("fails.dat"));
			DataOutputStream fout2=new DataOutputStream(new FileOutputStream("temp.dat"));
			while(fin.available()>0){
				x=fin.readInt();
				if(x<60)
					fout1.writeInt(x);
				else
					fout2.writeInt(x);
			}
			fin.close();
			fout1.close();
			fout2.close();
			File oldFile=new File("grades.dat");
			oldFile.delete();
			File newFile=new File("temp.dat");
			newFile.renameTo(oldFile);
		}catch(Exception e){
			e.printStackTrace();
		}
	}
}