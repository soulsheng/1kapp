public class ch5ex7{
	public static void main(String[]args){
		String s1,s2,s3;
		String maxStr;
		System.out.print("Enter first string: ");
		s1=Keyboard.readString();
		System.out.print("Enter second string: ");
		s2=Keyboard.readString();
		System.out.print("Enter third string: ");
		s3=Keyboard.readString();
		maxStr=max(s1,s2,s3);
		System.out.println("The max of string is "+maxStr);
	}
	static String max(String a,String b,String c){
		//a���a��b�д���ַ���
		if(b.compareTo(a)>0)
			a=b;
		//a���a��c�д���ַ���
		if(c.compareTo(a)>0)
			a=c;
		return a;//��������ַ���
	}
}