public class ch5ex1{
	public static void main(String[]args){
		for (int j=0;j<5;j++){
			System.out.print("Line"+(j+1));
			drawStars();
		}
	}
	static void drawStars(){
		for(int j=0;j<50;j++)
			System.out.print('*');
		System.out.println();
	}
}