class Soap{
  	private String s;
	public Soap(){
		System.out.println("Soap()");
    	s=new String("Constructed");
  	}
  	public String toString(){return s;}
}
class Bath{
  	private String s1=new String("Happy"),s2="Happy",s3,s4;
  	private Soap castille;//×éºÏ
  	private int i;double toy;
  	public Bath(){
    	System.out.println("Inside Bath()");
    	s3=new String("Joy");
    	i=47;toy =3.14;
    	castille =new Soap();
  	}
	public void display(){
    	if(s4==null)
      		s4=new String("Joy");
    	System.out.println("s1= :" +s1);
    	System.out.println("s2= :" +s2);
    	System.out.println("s3= :" +s3);
		System.out.println("s4= :" +s4);
    	System.out.println("i= :" +i);
    	System.out.println("toy= :"+toy);
    	System.out.println("castille= :"+castille);
  	}
}  
public class ch9ex1{
	public static void main(String[]args){
    	Bath b=new Bath();
    	b.display();
  	}
} 
