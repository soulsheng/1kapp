public class ch5ex21{
	static int SeqSearch(int a[],int key){
	//��˳���a[0..a.length-1]��˳�����Ԫ��ֵΪkey��Ԫ��
    //�ɹ�ʱ�����ҵ���Ԫ��λ�ã�ʧ��ʱ����0
		int i;
		for(i=a.length-1;a[i]!=key&&i>0;i--)
			;//forѭ��ִ�пղ���,�ӱ����ǰ��
		return i;//��iΪ0����ʾ����ʧ�ܣ�����a[i]��Ҫ�ҵ�Ԫ��
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