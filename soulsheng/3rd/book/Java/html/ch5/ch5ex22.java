public class ch5ex22{
	static int BinSearch(int a[],int key){
		//�������a[0..a.length-1]�н��ж��ֲ��ң�
		//�ɹ�ʱ����Ԫ�ص�λ�ã�ʧ��ʱ������
		int low=0,high=a.length-1,mid;//�õ�ǰ���������ϡ��½�ĳ�ֵ
		while(low<=high){//��ǰ��������a[low..high]�ǿ�
			mid=(int)((low+high)/2);
			if(a[mid]==key)
				return mid;//���ҳɹ�����
			if(a[mid]>key)
				high=mid-1;//������a[low..mid-1]�в���
			else
				low=mid+1;//������R[mid+1..high]�в���
		}
		return 0;//��low>highʱ��ʾ��������Ϊ�գ�����ʧ��
	}
	static void SelectionSort(int a[]){//ѡ������
		int min;
		for(int j=0;j<a.length-1;j++){
			min=j;
			for(int k=j+1;k<a.length;k++){ 
  				if(a[k]<a[min]) 
  					min=k; 
  			} 
  			int t=a[min]; 
  			a[min]=a[j]; 
  			a[j]=t; 
  		} 
  	} 
	public static void main(String[]args){
		int intArray[]={1,13,3,6,10,55,98,2,87,12,34,75,33,47};
		int k,index;
		SelectionSort(intArray);//������
		System.out.println("After sorted array: ");
		for(int j=0;j<intArray.length;j++)
			System.out.print(intArray[j]+" ");
		System.out.println();
		System.out.print("Enter a number searched :");
		k=Keyboard.readInt();
		index=BinSearch(intArray,k);
		if(index==0)
			System.out.println(k+" is not exist in array");
		else// index��0��ʼ
			System.out.println(k+" is at "+index+" in array");
	}
}