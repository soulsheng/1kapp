public class ch3ex21{
	final static double Sentinel=0.000001;
	public static void main(String[]args){
		double result=1.0,n=1.0,x=0.2,y=1.0;
		do{
			result=result+x/y;
			n=n+1;x=x*x;y=n*y;
		}while(x/y>Sentinel);
		System.out.println("The Result:"+result);
	}
}