public class ch5ex19{
	static void QuickSort(int a[],int low,int high){
		int index[]=new int[2];
		if(low<high){//�������䳤�ȴ���1ʱ��������
			Partition(a,low,high,index);//��L[low..high]������
			QuickSort(a,low,index[0]);//��������ݹ�����
			QuickSort(a,index[1],high);//��������ݹ�����
		}
	}
	static void Partition(int a[],int p,int r,int ind[]){
		int i,j,k,pivot;
		pivot=a[(int)(p+r)/2];
		i=p;j=p;k=r;
  		while(j!=k){
  			if(a[j]==pivot){
  				j++;
  			}
  			else if(a[j]<pivot){
  				int temp;temp=a[j];a[j]=a[i];a[i]=temp;
  				j++;i++;
  				}else{
  					int temp;
  					temp=a[j];a[j]=a[k-1];a[k-1]=temp;k--;
  					}
  		}
  		ind[0]=i;ind[1]=j;		 				
	}
	public static void main(String[]args){
		int intArray[]={1,13,3,6,10,55,98,2,87,12,34,75,33,47};
		QuickSort(intArray,0,intArray.length);
		for(int j=0;j<intArray.length;j++)
			System.out.println(intArray[j]);
	}
}
