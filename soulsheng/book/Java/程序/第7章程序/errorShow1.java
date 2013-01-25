public class errorShow1{
	//关键字string拼写错误,其中s应该大写
	public static void main(string[]args){
		//j变量没有定义
		j=Keyboard.readInt();
		if(j>0)
			System.out.println("j is greater than zero");
		else if(j<0)
				System.out.println("j is equals to zero");
			else
				//遗漏了分号";"
				System.out.println("j is less than zero")
		int x=120/j;
		System.out.println(x);
	}
}
