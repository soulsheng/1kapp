public class ch5ex11{
	static void swapArray(char c1[],char c2[]){
		char ch;
		for(int j=0;j<c1.length;j++){
			ch=c1[j];c1[j]=c2[j];c2[j]=ch;
		}
	}
	static void initArray(char c1[]){
		int a;
		for(int j=0;j<c1.length;j++){
			a=(int)(Math.random()*10000000)%94+32;
			c1[j]=(char)a;
		}
	}
	static void printArray(char c[]){		
		for(int j=0;j<c.length;j++)
			System.out.print(c[j]+"  ");
		System.out.println();
	}
	public static void main(String[]args){
		char ch1[]=new char[20];
		char ch2[]=new char[20];
		initArray(ch1);
		initArray(ch2);
		System.out.println("The first array of character before swap: ");
		printArray(ch1);
		System.out.println("The second array of character before swap: ");
		printArray(ch2);
		swapArray(ch1,ch2);
		System.out.println("The first array of character after swap: ");
		printArray(ch1);
		System.out.println("The second array of character after swap: ");
		printArray(ch2);
	}
}