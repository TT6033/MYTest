class Node
{
	private:
	string name;
	public:
	class Node* pparent;
	class Node* pbrother;
	public:
	void findparent(Node n)
	{
		class Node* pn=&n;//这个是往上找父类节点的指针
		
		while(pn->parent!=NULL)
		{
		
			class Node* pbn=pn->parent->pbrother;//这个是往右找兄弟节点的指针
			print pn->parent->name;
			while(pbn!=NULL)
			{
				print pbn->name;
				pbn=pbn->pbrother;
			}
			pn=pn->parent->pparent;
		}
		
	}
}