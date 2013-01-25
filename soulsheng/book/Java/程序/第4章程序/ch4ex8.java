public class ch4ex8{
	public static void main(String[]args){
		char ch;
		int index;
		int freq[]=new int[26];
		for(int j=0;j<26;j++)
			freq[j]=0;
		System.out.println("Enter list character");
		ch=Keyboard.readChar();
		while(ch!='#'){
			if((ch>='A' && ch<='Z') || (ch>='a' && ch<='z')){
				ch=Character.toUpperCase(ch);
				index=(int)ch-(int)'A';
				freq[index]++;
			}
			ch=Keyboard.readChar();
		}
		for(int j=0;j<26;j++)
			System.out.print((char)(j+65)+"  ");
		System.out.println();
		for(int j=0;j<26;j++)
			System.out.print(freq[j]+"  ");
		System.out.println();
	}
}