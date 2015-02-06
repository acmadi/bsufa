// JavaScript Document
function doSelect(value)
{
		var arr = document.status.elements;
		for(i=0;i<arr.length;i++)
		{
				if(arr[i].name=='chk[]')
				{
						arr[i].checked = value;
				}
		}
}