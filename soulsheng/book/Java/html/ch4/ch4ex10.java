public class ch4ex10{
	public static void main(String[]args){
		String s1,s2,s3;
		System.out.print("Enter first string:");
		s1=Keyboard.readString();
		System.out.println();
		System.out.print("Enter second string:");
		s2=Keyboard.readString();
		System.out.println();
		System.out.print("Enter third string:");
		s3=Keyboard.readString();
		System.out.println();
		//sort value
		if(s1.compareTo(s2)>0)
			;
		else{
			String temp;temp=s1;
			s1=s2;s2=temp;
		}
		if(s1.compareTo(s3)>0)
			;
		else{
			String temp;temp=s1;
			s1=s3;s3=temp;
		}
		if(s2.compareTo(s3)>0)
			;
		else{
			String temp;temp=s2;
			s2=s3;s3=temp;
		}
		System.out.print("Sorted:");
		System.out.println(s1);
		System.out.println(s2);
		System.out.println(s3);
	}
}