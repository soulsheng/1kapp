public class ch3ex18{
	public static void main(String[]args){
		boolean prime;
		for(int j=2;j<=50;j++){
			prime=true;
			for(int k=2;k<j;k++){
				if(j%k!=0)
					continue;
				else{
					prime=false;
					break;
				}
			}
			if(prime)
				System.out.println(j+"is prime");
		}
	}
}