public class ch5ex22{
	static int BinSearch(int a[],int key){
		//在有序表a[0..a.length-1]中进行二分查找，
		//成功时返回元素的位置，失败时返回零
		int low=0,high=a.length-1,mid;//置当前查找区间上、下界的初值
		while(low<=high){//当前查找区间a[low..high]非空
			mid=(int)((low+high)/2);
			if(a[mid]==key)
				return mid;//查找成功返回
			if(a[mid]>key)
				high=mid-1;//继续在a[low..mid-1]中查找
			else
				low=mid+1;//继续在R[mid+1..high]中查找
		}
		return 0;//当low>high时表示查找区间为空，查找失败
	}
	static void SelectionSort(int a[]){//选择排序
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
		SelectionSort(intArray);//先排序
		System.out.println("After sorted array: ");
		for(int j=0;j<intArray.length;j++)
			System.out.print(intArray[j]+" ");
		System.out.println();
		System.out.print("Enter a number searched :");
		k=Keyboard.readInt();
		index=BinSearch(intArray,k);
		if(index==0)
			System.out.println(k+" is not exist in array");
		else// index从0开始
			System.out.println(k+" is at "+index+" in array");
	}
}