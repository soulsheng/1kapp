public class ch5ex21{
	static int SeqSearch(int a[],int key){
	//在顺序表a[0..a.length-1]中顺序查找元素值为key的元素
    //成功时返回找到的元素位置，失败时返回0
		int i;
		for(i=a.length-1;a[i]!=key&&i>0;i--)
			;//for循环执行空操作,从表后往前找
		return i;//若i为0，表示查找失败，否则a[i]是要找的元素
	}
	public static void main(String[]args){
		int intArray[]={1,13,3,6,10,55,98,2,87,12,34,75,33,47};
		int k,index;
		System.out.print("Enter a number searched :");
		k=Keyboard.readInt();
		index=SeqSearch(intArray,k);
		if(index==0)
			System.out.println(k+" is not exist in array");
		else
			System.out.println(k+" is at "+index+" in array");
	}
}