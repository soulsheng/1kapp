class base{
	private int x;
	public base(int n){x=n;}
	public int get(){return x;}
	public void setb(int n){x=n;};
}		
class inheritance extends base{
	private int k;
	public inheritance(int b,int i){
		super(b);k=i;
	}
	public void seti(int n1){setb(n1);}
	private int get(){return super.get();}
	public int geti(){return k;}
}
public class ch9ex3{
	public static void main(String[]args){
		inheritance ex=new inheritance(15,10);
		System.out.println(ex.geti());
		System.out.println(ex.get());
		ex.seti(25);
		System.out.println(ex.get());
	}
}