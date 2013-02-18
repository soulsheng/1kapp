class pointer{
	private int x,y;
	public void init(int cx,int cy){
		x=cx;y=cy;
	}
	public void display(){
		System.out.println("x= "+x+" "+"y= "+y);
	}
}
public class ch6ex13{
	public static void main(String[]args){
		pointer pta=new pointer();
		pta.init(15,24);
		pta.display();
	}
}