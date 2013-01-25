public class ch3ex17{
	public static void main(String[]args){
		int sum=0,j;
		for(j=1;;j++){
			sum=sum+j;
			if(sum>65535) break;
		}
		System.out.println("j="+j);
		System.out.println("sum="+sum);
	}
}